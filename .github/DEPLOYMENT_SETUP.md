# Deployment Setup Guide

This repository now includes GitHub Actions workflows for automated deployment and Docker image publishing.

## Required GitHub Secrets

Before the workflows can run successfully, the repository maintainer must configure the following secrets in **Settings → Secrets and variables → Actions**:

### For SSH Deployment (`deploy-ssh.yml`)

The following secrets are **required**:

- **`SSH_HOST`**: The hostname or IP address of your VPS server
- **`SSH_USERNAME`**: The SSH username for connecting to the server
- **`SSH_PRIVATE_KEY`**: The private SSH key for authentication (contents of the private key file)
- **`TARGET_DIR`**: The target directory on the server where the application should be deployed (e.g., `/var/www/html/laravel-app`)

The following secrets are **optional**:

- **`SSH_PORT`**: The SSH port (defaults to `22` if not provided)
- **`SKIP_MIGRATIONS`**: Set to `true` to skip database migrations during deployment (useful for environments where migrations are handled separately)

### For Docker Publishing (`build-and-publish-docker.yml`)

No additional secrets are required! This workflow uses the built-in `GITHUB_TOKEN` which is automatically provided by GitHub Actions.

However, you may need to:
1. Ensure that the repository has **write** permissions to GitHub Packages
2. Make the container registry public or configure access for users who need to pull the image

## Workflows Overview

### 1. Deploy via SSH (`deploy-ssh.yml`)

**Triggers**: Push to `main` branch

**What it does**:
1. Checks out the code
2. Sets up PHP 8.1 with required extensions
3. Installs Composer dependencies with caching
4. Sets up Node.js 18
5. Installs npm dependencies and builds production assets
6. Creates a deployment archive (excluding `vendor` and `node_modules`)
7. Copies the archive to the server via SCP
8. Extracts the archive on the server
9. Runs `composer install --no-dev`
10. Creates storage symlink
11. Updates file permissions
12. Runs database migrations (unless `SKIP_MIGRATIONS=true`)
13. Clears and caches configuration, routes, and views

### 2. Build and Publish Docker Image (`build-and-publish-docker.yml`)

**Triggers**: Push to `main` branch

**What it does**:
1. Checks out the code
2. Sets up QEMU and Docker Buildx for multi-architecture builds
3. Logs in to GitHub Container Registry (ghcr.io)
4. Builds a multi-architecture Docker image (linux/amd64, linux/arm64)
5. Pushes the image with two tags:
   - `ghcr.io/<username>/pw-estoque_pro:latest`
   - `ghcr.io/<username>/pw-estoque_pro:<commit-sha>`

### 3. Dockerfile

**Multi-stage build**:

**Stage 1 - node_builder**: 
- Uses Node.js 18 Alpine
- Installs npm dependencies
- Builds production assets with Laravel Mix

**Stage 2 - app**: 
- Uses PHP 8.1-FPM
- Installs system libraries and PHP extensions (pdo_mysql, mbstring, zip, exif, pcntl, gd)
- Copies Composer from official image
- Installs PHP dependencies
- Copies application code and built assets
- Sets proper permissions
- Caches routes
- Exposes port 9000 for PHP-FPM

## Using the Docker Image

After the image is published, you can pull and run it:

```bash
# Pull the latest image
docker pull ghcr.io/<username>/pw-estoque_pro:latest

# Run the container
docker run -d -p 9000:9000 \
  -v /path/to/.env:/var/www/html/.env \
  ghcr.io/<username>/pw-estoque_pro:latest
```

**Note**: You'll typically need to pair this with an Nginx container and configure a proper `.env` file for your application.

## SSH Key Setup

To set up the SSH private key secret:

1. Generate an SSH key pair on your local machine (if you don't have one):
   ```bash
   ssh-keygen -t rsa -b 4096 -C "github-actions@deployment"
   ```

2. Copy the public key to your server:
   ```bash
   ssh-copy-id -i ~/.ssh/id_rsa.pub username@your-server.com
   ```

3. Copy the **private key** contents:
   ```bash
   cat ~/.ssh/id_rsa
   ```

4. Add the private key contents as the `SSH_PRIVATE_KEY` secret in GitHub

## Testing

To test the workflows without affecting production:

1. Create a test branch
2. Modify the workflow files to trigger on your test branch instead of `main`
3. Push to the test branch and verify the workflows run successfully
4. Once verified, merge to `main`

## Troubleshooting

- **SSH connection fails**: Verify the SSH_HOST, SSH_USERNAME, and SSH_PRIVATE_KEY are correct
- **Permission denied errors**: Ensure the SSH key has proper permissions on the server
- **Migrations fail**: Set `SKIP_MIGRATIONS=true` if you handle migrations manually
- **Docker build fails**: Check that all dependencies in `package.json` and `composer.json` are resolvable
- **Package publishing fails**: Verify the repository has package write permissions enabled
