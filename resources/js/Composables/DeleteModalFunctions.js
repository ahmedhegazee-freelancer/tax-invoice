import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

export const deleteRouteKey = ref("");
export const deleteLink = ref("");
export const refreshRecords = ref("");
export const deleteConfirmationModal = ref(false);
export const currentRecord = ref(null);
export const openDeleteModal = (id) => {
    currentRecord.value = id;
    deleteConfirmationModal.value = true;
};
export const closeDeleteModal = () => {
    currentRecord.value = null;
    deleteConfirmationModal.value = false;
};
export const routingParam = {};

export const confirmDelete = () => {
    const form = useForm();
    routingParam[deleteRouteKey.value] = currentRecord.value;
    form.delete(route(deleteLink.value, routingParam), {
        onSuccess: () => {
            deleteConfirmationModal.value = false;
            Inertia.reload({ only: [refreshRecords.value] });
        },
    });
};
