<script>
    // Function to open popup form
    function openPopup(popupId) {
        const popup = document.getElementById(popupId);
        popup.classList.add('popup-form--open');
    }

    // Function to close popup form
    function closePopup() {
        const popups = document.querySelectorAll('.popup-form');
        popups.forEach(popup => {
            popup.classList.remove('popup-form--open');
        });
    }
</script>

</div>

<script>
    const searchInput = document.querySelector('#search');
    const tableRows = document.querySelectorAll('#table-section__tbody tr');
    const tableHeaders = document.querySelectorAll('.table-section__table th');

    let sortColumn = null;
    let sortDirection = 'asc';

    function sortTable(column) {
        const rows = Array.from(tableRows);

        rows.sort((a, b) => {
            const aValue = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
            const bValue = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim();

            if (aValue < bValue) {
                return sortDirection === 'asc' ? -1 : 1;
            } else if (aValue > bValue) {
                return sortDirection === 'asc' ? 1 : -1;
            } else {
                return 0;
            }
        });

        rows.forEach(row => {
            document.querySelector('#table-section__tbody').appendChild(row);
        });
    }

    tableHeaders.forEach((header, index) => {
        header.addEventListener('click', () => {
            if (sortColumn === index) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = index;
                sortDirection = 'asc';
            }

            sortTable(sortColumn);
        });
    });

    searchInput.addEventListener('keyup', function(event) {
        const searchTerm = event.target.value.toLowerCase();

        tableRows.forEach(function(row) {
            const itemName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const itemId = row.querySelector('td:nth-child(1)').textContent.toLowerCase();

            if (itemName.includes(searchTerm) || itemId.includes(searchTerm)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

</main>
<script>
    // SIDEBAR TOGGLE

    let sidebarOpen = false;
    const sidebar = document.getElementById('sidebar');

    function openSidebar() {
        if (!sidebarOpen) {
            sidebar.classList.add('sidebar-responsive');
            sidebarOpen = true;
        }
    }

    function closeSidebar() {
        if (sidebarOpen) {
            sidebar.classList.remove('sidebar-responsive');
            sidebarOpen = false;
        }
    }
</script>
</body>

</html>