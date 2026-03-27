<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">All Tickets</h2>
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Ticket List</h5>
            <button onclick="showCreateModal()" class="btn btn-success">
                <i class="bi bi-plus-lg"></i> New Ticket
            </button>
        </div>

        <div class="card-body">
            <!-- Filter -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" id="search" class="form-control" 
                           placeholder="Search title or description..." 
                           onkeyup="if(event.keyCode===13) loadTickets()">
                </div>
                <div class="col-md-3">
                    <select id="status_filter" class="form-select" onchange="loadTickets()">
                        <option value="">All Status</option>
                        <option value="Open">Open</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button onclick="loadTickets()" class="btn btn-secondary w-100">Apply Filter</button>
                </div>
            </div>

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tickets-body"></tbody>
            </table>

            <div id="pagination" class="d-flex justify-content-center gap-2"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Create Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="ticketForm">
                    <div class="modal-body">
                        <input type="hidden" id="ticket_id">

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input id="title" type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="description" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select id="status" class="form-select">
                                    <option value="Open">Open</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Priority</label>
                                <select id="priority" class="form-select">
                                    <option value="">Select Priority</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete this ticket?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" onclick="confirmDelete()">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<script>

    let deleteId = null;
const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));


    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const modal = new bootstrap.Modal(document.getElementById('ticketModal'));

    function loadTickets(page = 1) {
        const search = document.getElementById('search').value;
        const status = document.getElementById('status_filter').value;

        fetch(`/tickets?page=${page}&search=${encodeURIComponent(search)}&status=${status}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            let html = '';
            data.data.forEach(t => {
                html += `
                <tr>
                    <td><strong>${t.title}</strong></td>
                    <td>${t.description.substring(0, 60)}...</td>
                    <td>
                        <span class="badge ${t.status==='Open'?'bg-warning':t.status==='In Progress'?'bg-info':'bg-success'}">
                            ${t.status}
                        </span>
                    </td>
                    <td>${t.priority || '-'}</td>
                    <td>${new Date(t.created_at).toLocaleDateString()}</td>
                    <td>
                        <button onclick="editTicket(${t.id})" class="btn btn-sm btn-primary">Edit</button>
                        <button onclick="deleteTicket(${t.id})" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>`;
            });

            document.getElementById('tickets-body').innerHTML = html || 
                `<tr><td colspan="6" class="text-center py-4 text-muted">No tickets found</td></tr>`;

            // Pagination
            let pagi = '';
            if (data.last_page > 1) {
                for (let i = 1; i <= data.last_page; i++) {
                    pagi += `<button onclick="loadTickets(${i})" class="btn btn-sm ${data.current_page===i ? 'btn-primary' : 'btn-outline-secondary'}">${i}</button> `;
                }
            }
            document.getElementById('pagination').innerHTML = pagi;
        });
    }

    function showCreateModal() {
        document.getElementById('modalTitle').innerText = 'Create New Ticket';
        document.getElementById('ticketForm').reset();
        document.getElementById('ticket_id').value = '';
        modal.show();
    }

    function hideModal() {
        modal.hide();
    }

    function editTicket(id) {
        fetch(`/tickets/${id}`, { headers: {'X-Requested-With': 'XMLHttpRequest'} })
            .then(r => r.json())
            .then(t => {
                document.getElementById('modalTitle').innerText = 'Edit Ticket';
                document.getElementById('ticket_id').value = t.id;
                document.getElementById('title').value = t.title;
                document.getElementById('description').value = t.description;
                document.getElementById('status').value = t.status;
                document.getElementById('priority').value = t.priority || '';
                modal.show();
            });
    }

    document.getElementById('ticketForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('ticket_id').value;
        const data = {
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            status: document.getElementById('status').value,
            priority: document.getElementById('priority').value
        };

        const url = id ? `/tickets/${id}` : '/tickets';
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        }).then(() => {
            hideModal();
            loadTickets();
        });
    });

    // function deleteTicket(id) {
    //     if (confirm('Delete this ticket?')) {
    //         fetch(`/tickets/${id}`, {
    //             method: 'DELETE',
    //             headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' }
    //         }).then(() => loadTickets());
    //     }
    // }

    // window.onload = () => loadTickets();

    function deleteTicket(id) {
    deleteId = id;   // 👈 id store karo
    deleteModal.show(); // 👈 modal open karo
   }

function confirmDelete() {
    fetch(`/tickets/${deleteId}`, {
        method: 'DELETE',
        headers: { 
            'X-CSRF-TOKEN': csrf, 
            'X-Requested-With': 'XMLHttpRequest' 
        }
    })
    .then(() => {
        deleteModal.hide();
        loadTickets();
    });
}

window.onload = () => loadTickets();
</script>