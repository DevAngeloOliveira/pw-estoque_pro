<div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Atualizar tabela de fornecedores
            function updateTable(suppliers) {
                const tbody = document.getElementById('suppliersTableBody');
                if (!tbody) return;

                tbody.innerHTML = '';

                if (suppliers.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>Nenhum fornecedor global cadastrado</p>
                            </td>
                        </tr>
                    `;
                    return;
                }

                suppliers.forEach(supplier => {
                    const statusBadge = supplier.active ?
                        '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Ativo</span>' :
                        '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800"><i class="fas fa-times-circle mr-1"></i>Inativo</span>';

                    const productsBadge = supplier.products_count > 0 ?
                        `<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">${supplier.products_count} produtos</span>` :
                        '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Sem produtos</span>';

                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">${supplier.name}</div>
                                <div class="text-sm text-gray-500">${productsBadge}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">${supplier.cnpj}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">${supplier.email}</div>
                                <div class="text-xs text-gray-500">${supplier.phone}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">${supplier.city}${supplier.state ? '/' + supplier.state : ''}</td>
                            <td class="px-6 py-4">${statusBadge}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="openModal(${supplier.id})" class="text-blue-600 hover:text-blue-800" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="confirmDelete(${supplier.id})" class="text-red-600 hover:text-red-800" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }

            // Atualizar stats
            window.addEventListener('stats-updated', event => {
                document.getElementById('totalSuppliers').textContent = event.detail.total;
                document.getElementById('activeSuppliers').textContent = event.detail.active;
                document.getElementById('suppliersInUse').textContent = event.detail.inUse;
            });

            // Atualizar tabela quando houver mudanças
            window.addEventListener('livewire:load', function() {
                updateTable(@json($suppliers));
            });

            // Buscar fornecedores
            document.getElementById('searchInput')?.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#suppliersTableBody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });

            // Confirmar exclusão
            window.confirmDelete = function(supplierId) {
                if (confirm('Tem certeza que deseja excluir este fornecedor global?')) {
                    window.Livewire.emit('deleteSupplier', supplierId);
                }
            };

            // Atualizar tabela após salvar
            window.addEventListener('supplier-saved', event => {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            });

            // Exibir erros
            window.addEventListener('supplier-error', event => {
                alert(event.detail.message);
            });

            // Exibir sucesso de exclusão
            window.addEventListener('supplier-deleted', event => {
                alert(event.detail.message);
                window.location.reload();
            });
        });
    </script>
</div>
