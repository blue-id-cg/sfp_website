import Quill from 'quill';

// Éditeur riche (contenu des actualités)
document.querySelectorAll('textarea[data-quill]').forEach((textarea) => {
    const container = document.createElement('div');
    textarea.insertAdjacentElement('afterend', container);
    textarea.classList.add('sr-only');

    const quill = new Quill(container, {
        theme: 'snow',
        placeholder: 'Rédigez le contenu de l\'actualité…',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ header: 2 }, { header: 3 }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['blockquote', 'link'],
                ['clean'],
            ],
        },
    });

    quill.root.innerHTML = textarea.value;

    quill.on('text-change', () => {
        textarea.value = quill.getText().trim() === '' ? '' : quill.root.innerHTML;
    });

    textarea.closest('form')?.addEventListener('submit', () => {
        textarea.value = quill.getText().trim() === '' ? '' : quill.root.innerHTML;
    });
});

// Menu latéral (mobile) : tiroir avec fond assombri
const adminSidebar = document.getElementById('admin-sidebar');
const adminBackdrop = document.getElementById('admin-backdrop');

const closeAdminSidebar = () => {
    adminSidebar?.classList.remove('open');
    adminBackdrop?.classList.add('hidden');
};

document.querySelector('[data-admin-menu-toggle]')?.addEventListener('click', () => {
    adminSidebar?.classList.add('open');
    adminBackdrop?.classList.remove('hidden');
});

adminBackdrop?.addEventListener('click', closeAdminSidebar);
adminSidebar?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeAdminSidebar));

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
