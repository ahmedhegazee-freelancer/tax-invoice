import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

export const changeStatusConfirmationModal = ref(false);
export const currentRecordStatus = ref(null);
export const changeStatusRoute = ref({
    route: "",
    paramsKey: "",
    dataName: "",
});
export const openChangeStatusModal = (id) => {
    currentRecordStatus.value = id;
    changeStatusConfirmationModal.value = true;
};
export const closeChangeStatusModal = () => {
    currentRecordStatus.value = null;
    changeStatusConfirmationModal.value = false;
};

export const confirmChangeStatus = () => {
    const form = useForm();
    const params = {};
    params[changeStatusRoute.value.paramsKey] = currentRecordStatus.value;
    form.put(route(changeStatusRoute.value.route, params), {
        onSuccess: () => {
            closeChangeStatusModal();
            Inertia.reload({ only: [changeStatusRoute.value.dataName] });
        },
    });
};
