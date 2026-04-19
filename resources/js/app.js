import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/* ========================================
   FUNCIONALIDAD ANDINA - TIENDA
   ======================================== */
document.addEventListener('DOMContentLoaded', function() {
    
    // 🔔 Auto-close alerts after 5 seconds
    document.querySelectorAll('[data-auto-close]').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.3s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // 🖼️ Preview de imagen al subir (para formularios de productos) con validación de tamaño
    const imageInput = document.querySelector('input[name="main_image"]');
    const preview = document.getElementById('image-preview');
    
    if (imageInput && preview) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                // Validar tamaño (máx 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('⚠️ La imagen no debe superar los 5MB');
                    imageInput.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // 🛒 Confirmación antes de eliminar (productos, usuarios, etc.)
    document.querySelectorAll('[data-confirm]').forEach(button => {
        button.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm') || '¿Estás seguro?';
            if (!confirm(message)) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });

    // 🎨 Efecto hover sutil en tarjetas de producto
    document.querySelectorAll('.card-product').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});