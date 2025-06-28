
    function toggleDropdown() {
        var menu = document.getElementById('dropdownMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    }

    // Đóng dropdown khi bấm ra ngoài
    window.addEventListener('click', function (e) {
        if (!e.target.closest('.user-dropdown')) {
        document.getElementById('dropdownMenu').style.display = 'none';
        }
    });