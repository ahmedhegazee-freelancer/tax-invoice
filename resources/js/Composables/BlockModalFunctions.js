import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

export const refreshRecords = ref("");
export const toggleBlockConfirmationModal = ref(false);
export const currentUser = ref(null);
export const openToggleBlockModal = (id) => {
    currentUser.value = id;
    toggleBlockConfirmationModal.value = true;
};
export const closeToggleBlockModal = () => {
    currentUser.value = null;
    toggleBlockConfirmationModal.value = false;
};

export const confirmToggleBlock = () => {
    const form = useForm();
    form.post(route("dashboard.toggle-block", { user: currentUser.value }), {
        onSuccess: () => {
            closeToggleBlockModal();
            Inertia.reload({ only: [refreshRecords.value] });
        },
    });
};
