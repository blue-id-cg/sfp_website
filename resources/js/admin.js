import Tagify from "@yaireo/tagify";
import { Notyf } from "notyf";
import Quill from "quill";

// Éditeur riche (contenu des actualités)
document.querySelectorAll("textarea[data-quill]").forEach((textarea) => {
    const container = document.createElement("div");
    textarea.insertAdjacentElement("afterend", container);
    textarea.classList.add("sr-only");

    const quill = new Quill(container, {
        theme: "snow",
        placeholder: "Rédigez le contenu de l'actualité…",
        modules: {
            toolbar: [
                ["bold", "italic", "underline"],
                [{ header: 2 }, { header: 3 }],
                [{ list: "ordered" }, { list: "bullet" }],
                ["blockquote", "link"],
                ["clean"],
            ],
        },
    });

    quill.root.innerHTML = textarea.value;

    quill.on("text-change", () => {
        textarea.value =
            quill.getText().trim() === "" ? "" : quill.root.innerHTML;
    });

    textarea.closest("form")?.addEventListener("submit", () => {
        textarea.value =
            quill.getText().trim() === "" ? "" : quill.root.innerHTML;
    });
});

// Menu latéral (mobile) : tiroir avec fond assombri
const adminSidebar = document.getElementById("admin-sidebar");
const adminBackdrop = document.getElementById("admin-backdrop");

const closeAdminSidebar = () => {
    adminSidebar?.classList.remove("open");
    adminBackdrop?.classList.add("hidden");
};

document
    .querySelector("[data-admin-menu-toggle]")
    ?.addEventListener("click", () => {
        adminSidebar?.classList.add("open");
        adminBackdrop?.classList.remove("hidden");
    });

adminBackdrop?.addEventListener("click", closeAdminSidebar);
adminSidebar
    ?.querySelectorAll("a")
    .forEach((link) => link.addEventListener("click", closeAdminSidebar));

// Menu utilisateur
const userMenu = document.querySelector("[data-user-menu]");
const userMenuPanel = document.querySelector("[data-user-menu-panel]");

document
    .querySelector("[data-user-menu-toggle]")
    ?.addEventListener("click", (event) => {
        event.stopPropagation();
        userMenuPanel?.classList.toggle("hidden");
    });

document.addEventListener("click", (event) => {
    if (userMenu && !userMenu.contains(event.target)) {
        userMenuPanel?.classList.add("hidden");
    }
});

// Champ tags (Tagify) — le textarea sous-jacent reste la source de vérité pour le serveur,
// une valeur par ligne (App\Http\Requests\Concerns\ParsesLineDelimitedFields).
document.querySelectorAll("textarea[data-tag-input]").forEach((textarea) => {
    const initialTags = textarea.value
        .split(/\r\n|\r|\n/)
        .map((tag) => tag.trim())
        .filter(Boolean);
    textarea.value = "";

    const tagify = new Tagify(textarea, {
        originalInputValueFormat: (values) =>
            values.map((tag) => tag.value).join("\n"),
        placeholder: "Ajouter un tag…",
    });

    tagify.addTags(initialTags);
});

// Notifications (Notyf) — messages flash de session affichés en toast plutôt qu'en bandeau statique.
export const notyf = new Notyf({
    duration: 4500,
    position: { x: "right", y: "top" },
    types: [
        { type: "success", background: "#16a34a" },
        { type: "error", background: "#dc2626", icon: false },
    ],
});

document.querySelectorAll("[data-flash]").forEach((el) => {
    const type = el.dataset.flash;
    const message = el.textContent.trim();
    if (message) {
        notyf.open({ type, message });
    }
});

// Confirmation dialog for destructive admin actions.
const confirmDialog = document.querySelector("[data-confirm-dialog]");
const confirmTitle = confirmDialog?.querySelector("#confirm-dialog-title");
const confirmMessage = confirmDialog?.querySelector("#confirm-dialog-message");
const confirmCancel = confirmDialog?.querySelector("[data-confirm-cancel]");
const confirmSubmit = confirmDialog?.querySelector("[data-confirm-submit]");
let pendingForm = null;
let lastTrigger = null;

document.querySelectorAll("form[data-confirm]").forEach((form) => {
    form.addEventListener("submit", (event) => {
        if (form.dataset.confirmed === "true") {
            delete form.dataset.confirmed;
            return;
        }

        event.preventDefault();
        pendingForm = form;
        lastTrigger = document.activeElement;
        if (confirmTitle)
            confirmTitle.textContent =
                form.dataset.confirmTitle || "Confirmer la suppression";
        if (confirmMessage)
            confirmMessage.textContent =
                form.dataset.confirmMessage || "Cette action est définitive.";
        confirmDialog?.showModal();
        confirmSubmit?.focus();
    });
});

const closeConfirmDialog = () => {
    pendingForm = null;
    confirmDialog?.close();
    lastTrigger?.focus();
    lastTrigger = null;
};

confirmCancel?.addEventListener("click", closeConfirmDialog);
confirmDialog?.addEventListener("cancel", (event) => {
    event.preventDefault();
    closeConfirmDialog();
});
confirmDialog?.addEventListener("click", (event) => {
    if (event.target === confirmDialog) closeConfirmDialog();
});
confirmSubmit?.addEventListener("click", () => {
    if (!pendingForm) return;

    const form = pendingForm;
    pendingForm = null;
    form.dataset.confirmed = "true";
    confirmDialog.close();
    form.requestSubmit();
});

// Sélecteur d'icône (bloc de contenu) — palette cliquable plutôt qu'un champ texte libre, pour
// qu'un admin ne puisse pas enregistrer une classe Hugeicons qui n'existe pas sans s'en apercevoir.
document.querySelectorAll("[data-icon-picker]").forEach((picker) => {
    const input = picker.querySelector("[data-icon-value]");
    const trigger = picker.querySelector("[data-icon-trigger]");
    const panel = picker.querySelector("[data-icon-panel]");
    const preview = picker.querySelector("[data-icon-preview]");
    const label = picker.querySelector("[data-icon-label]");
    if (!input || !trigger || !panel || !preview || !label) return;

    const select = (value) => {
        input.value = value;
        preview.className = value ? `hgi-stroke ${value}` : "hgi-stroke";
        preview.style.visibility = value ? "visible" : "hidden";
        label.textContent = value || "Aucune icône";
        label.classList.toggle("text-gray-400", !value);
        label.classList.toggle("text-gray-900", Boolean(value));

        panel.querySelectorAll("[data-icon-option]").forEach((option) => {
            const isSelected =
                value !== "" && option.dataset.iconOption === value;
            option.classList.toggle("bg-gray-900", isSelected);
            option.classList.toggle("text-white", isSelected);
        });
    };

    trigger.addEventListener("click", () => {
        panel.hidden = !panel.hidden;
    });

    panel.querySelectorAll("[data-icon-option]").forEach((option) => {
        option.addEventListener("click", () => {
            select(option.dataset.iconOption ?? "");
            panel.hidden = true;
        });
    });

    document.addEventListener("click", (event) => {
        if (!picker.contains(event.target)) panel.hidden = true;
    });

    select(input.value);
});

// Zone de dépôt de fichier (upload image)
document.querySelectorAll("[data-file-input]").forEach((input) => {
    const drop = input.closest(".field")?.querySelector("[data-file-drop]");
    const nameEl = drop?.querySelector("[data-file-name]");
    if (!drop || !nameEl) return;

    input.addEventListener("change", () => {
        if (input.files?.[0]) nameEl.textContent = input.files[0].name;
    });

    ["dragover", "dragleave", "drop"].forEach((eventName) => {
        drop.addEventListener(eventName, (event) => {
            event.preventDefault();
            drop.classList.toggle("drag", eventName === "dragover");
        });
    });

    drop.addEventListener("drop", (event) => {
        if (event.dataTransfer?.files?.[0]) {
            input.files = event.dataTransfer.files;
            nameEl.textContent = event.dataTransfer.files[0].name;
        }
    });
});
