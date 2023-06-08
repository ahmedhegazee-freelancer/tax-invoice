<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">Unsent Invoices</h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <div class="w-56 relative text-slate-500">
                    <TomSelect
                        id="crud-form-2"
                        v-model="searchStatus.branch"
                        class="w-full"
                        placeholder="Doctors"
                        :options="{ create: false }"
                    >
                        <option value="">Select Branch</option>
                        <option
                            v-for="(branch, index) in props.branches"
                            :key="index"
                            :value="branch.id"
                        >
                            {{ branch.name }}
                        </option>
                    </TomSelect>
                </div>

                <div class="w-56 relative text-slate-500">
                    <VueDatePicker
                        :enable-time-picker="false"
                        v-model="searchStatus.date"
                        :format="format"
                        range
                    />
                </div>
                <div class="w-56 relative text-slate-500 mx-4">
                    <input
                        id="crud-form-1"
                        type="checkbox"
                        v-model="searchStatus.is_prod"
                        class="form-control w-full"
                        placeholder="Name"
                    />
                </div>
                <div
                    class="intro-y col-span-1 flex flex-wrap sm:flex-nowrap items-center ml-2"
                >
                    <button
                        class="btn btn-primary shadow-md mr-2"
                        @click="exportExcel"
                    >
                        <PrinterIcon />
                    </button>
                    <button
                        class="btn btn-primary shadow-md mr-2"
                        @click="sendUnsentInvoices"
                    >
                        <UploadIcon />
                    </button>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">ticket id</th>
                            <th class="whitespace-nowrap">closing date</th>
                            <th class="whitespace-nowrap">branch</th>
                            <th class="whitespace-nowrap">is prod</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(ticket, fakerKey) in props.invoices.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{ ticket.ticket_id }}
                            </td>
                            <td>
                                {{ ticket.date }}
                            </td>
                            <td>
                                {{ ticket.branch_name }}
                            </td>
                            <td>
                                {{ ticket.is_prod == 1 ? "Yes" : "No" }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.invoices.links" />
            </div>
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
    </AuthenticatedLayout>
</template>
<script setup>
import { watch } from "@vue/runtime-core";
import { useI18n } from "vue-i18n";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
const { t } = useI18n();
const props = defineProps({
    invoices: Object,
    branches: Array,
});
const searchStatus = ref({
    branch: "",
    date: "",
    is_prod: null,
});
watch(searchStatus.value, (newSearch) => {
    console.log(newSearch);
    _.debounce(() => {
        Inertia.reload({
            only: ["invoices"],
            preserveState: true,
            data: newSearch,
        });
    }, 500)();
});
const format = (date) => {
    if (date.length == 1) {
        return formatDate(date[0]);
    }
    return formatDate(date[0]) + " - " + formatDate(date[1]);
};
const exportExcel = () => {
    window.open(
        route("dashboard.invoices.export-json", searchStatus.value),
        "_blank"
    );
};
const formatDate = (date) => {
    if (date == undefined) return;
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    return `${year}-${month}-${day}`;
};

const sendUnsentInvoices = () => {
    Inertia.post(route("dashboard.invoices.send.unsent-invoices"), {
        data: searchStatus.value,
    });
};
</script>
<style></style>
