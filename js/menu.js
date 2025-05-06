document.querySelectorAll('.has-submenu > a').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const submenu = this.nextElementSibling;
        const parent = this.parentElement;
        
        // Cierra otros submenús
        document.querySelectorAll('.submenu').forEach(sub => {
            if(sub !== submenu) sub.classList.remove('active');
        });
        
        // Alternar estado
        parent.classList.toggle('active');
        submenu.classList.toggle('active');
    });
});

// Cerrar menú al hacer clic fuera
document.addEventListener('click', function(e) {
    if(!e.target.closest('.has-submenu')) {
        document.querySelectorAll('.submenu').forEach(sub => {
            sub.classList.remove('active');
        });
    }
});
