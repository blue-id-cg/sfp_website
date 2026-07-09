// Menu latéral (mobile)
document.querySelector('[data-admin-menu-toggle]')?.addEventListener('click', () => {
    document.getElementById('admin-sidebar')?.classList.toggle('hidden');
    document.getElementById('admin-sidebar')?.classList.toggle('flex');
});

// Menu utilisateur
const userMenu = document.querySelector('[data-user-menu]');
const userMenuPanel = document.querySelector('[data-user-menu-panel]');

document.querySelector('[data-user-menu-toggle]')?.addEventListener('click', (event) => {
    event.stopPropagation();
    userMenuPanel?.classList.toggle('hidden');
});

document.addEventListener('click', (event) => {
    if (userMenu && !userMenu.contains(event.target)) {
        userMenuPanel?.classList.add('hidden');
    }
});

// Zone de dépôt de fichier (upload image)
document.querySelectorAll('[data-file-input]').forEach((input) => {
    const drop = input.closest('.field')?.querySelector('[data-file-drop]');
    const nameEl = drop?.querySelector('[data-file-name]');
    if (!drop || !nameEl) return;

    input.addEventListener('change', () => {
        if (input.files?.[0]) nameEl.textContent = input.files[0].name;
    });

    ['dragover', 'dragleave', 'drop'].forEach((eventName) => {
        drop.addEventListener(eventName, (event) => {
            event.preventDefault();
            drop.classList.toggle('drag', eventName === 'dragover');
        });
    });

    drop.addEventListener('drop', (event) => {
        if (event.dataTransfer?.files?.[0]) {
            input.files = event.dataTransfer.files;
            nameEl.textContent = event.dataTransfer.files[0].name;
        }
    });
});
