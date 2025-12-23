/**
 * Serviço para requisições à API REST
 */
class ApiService {
    constructor() {
        this.baseURL = '/api';
        this.token = localStorage.getItem('api_token');
    }

    /**
     * Define o token de autenticação
     */
    setToken(token) {
        this.token = token;
        localStorage.setItem('api_token', token);
    }

    /**
     * Remove o token de autenticação
     */
    clearToken() {
        this.token = null;
        localStorage.removeItem('api_token');
    }

    /**
     * Obtém headers padrão para requisições
     */
    getHeaders() {
        const headers = {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        };

        // CSRF Token do Laravel
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
            headers['X-CSRF-TOKEN'] = csrfToken;
        }

        // Bearer Token
        if (this.token) {
            headers['Authorization'] = `Bearer ${this.token}`;
        }

        return headers;
    }

    /**
     * Faz requisição HTTP
     */
    async request(method, endpoint, data = null, options = {}) {
        const config = {
            method,
            headers: this.getHeaders(),
            ...options,
        };

        // Adiciona body se não for GET
        if (data && method !== 'GET') {
            if (data instanceof FormData) {
                // Remove Content-Type para FormData (deixa o browser definir)
                delete config.headers['Content-Type'];
                config.body = data;
            } else {
                config.headers['Content-Type'] = 'application/json';
                config.body = JSON.stringify(data);
            }
        }

        try {
            const response = await fetch(`${this.baseURL}${endpoint}`, config);
            const responseData = await response.json();

            if (!response.ok) {
                throw {
                    status: response.status,
                    message: responseData.message || 'Erro na requisição',
                    errors: responseData.errors || {},
                    data: responseData,
                };
            }

            return responseData;
        } catch (error) {
            console.error('API Error:', error);
            throw error;
        }
    }

    /**
     * GET Request
     */
    async get(endpoint, params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const url = queryString ? `${endpoint}?${queryString}` : endpoint;
        return this.request('GET', url);
    }

    /**
     * POST Request
     */
    async post(endpoint, data) {
        return this.request('POST', endpoint, data);
    }

    /**
     * PUT Request
     */
    async put(endpoint, data) {
        return this.request('PUT', endpoint, data);
    }

    /**
     * PATCH Request
     */
    async patch(endpoint, data) {
        return this.request('PATCH', endpoint, data);
    }

    /**
     * DELETE Request
     */
    async delete(endpoint) {
        return this.request('DELETE', endpoint);
    }

    // ============ AUTH ============

    async login(email, password, guard = 'web') {
        const response = await this.post('/login', { email, password, guard });
        if (response.access_token) {
            this.setToken(response.access_token);
        }
        return response;
    }

    async logout() {
        await this.post('/logout');
        this.clearToken();
    }

    async me() {
        return this.get('/me');
    }

    async updateProfile(data) {
        return this.put('/profile', data);
    }

    // ============ PRODUCTS ============

    async getProducts(params = {}) {
        return this.get('/products', params);
    }

    async getProduct(id) {
        return this.get(`/products/${id}`);
    }

    async createProduct(data) {
        return this.post('/products', data);
    }

    async updateProduct(id, data) {
        return this.put(`/products/${id}`, data);
    }

    async deleteProduct(id) {
        return this.delete(`/products/${id}`);
    }

    // ============ CATEGORIES ============

    async getCategories(params = {}) {
        return this.get('/categories', params);
    }

    async getCategory(id) {
        return this.get(`/categories/${id}`);
    }

    async createCategory(data) {
        return this.post('/categories', data);
    }

    async updateCategory(id, data) {
        return this.put(`/categories/${id}`, data);
    }

    async deleteCategory(id) {
        return this.delete(`/categories/${id}`);
    }

    // ============ SUPPLIERS ============

    async getSuppliers(params = {}) {
        return this.get('/suppliers', params);
    }

    async getSupplier(id) {
        return this.get(`/suppliers/${id}`);
    }

    async createSupplier(data) {
        return this.post('/suppliers', data);
    }

    async updateSupplier(id, data) {
        return this.put(`/suppliers/${id}`, data);
    }

    async deleteSupplier(id) {
        return this.delete(`/suppliers/${id}`);
    }

    // ============ MOVEMENTS ============

    async getMovements(params = {}) {
        return this.get('/movements', params);
    }

    async getMovement(id) {
        return this.get(`/movements/${id}`);
    }

    async createMovement(data) {
        return this.post('/movements', data);
    }

    async deleteMovement(id) {
        return this.delete(`/movements/${id}`);
    }

    // ============ COMPANIES ============

    async getCompanies(params = {}) {
        return this.get('/companies', params);
    }

    async getCompany(id) {
        return this.get(`/companies/${id}`);
    }

    async createCompany(data) {
        return this.post('/companies', data);
    }

    async updateCompany(id, data) {
        return this.put(`/companies/${id}`, data);
    }

    async deleteCompany(id) {
        return this.delete(`/companies/${id}`);
    }
}

// Exporta instância global
window.api = new ApiService();
