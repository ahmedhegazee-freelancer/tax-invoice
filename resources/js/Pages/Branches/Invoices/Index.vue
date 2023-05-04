<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ props.branch.name }} > Invoices
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link class="btn btn-primary shadow-md mr-2" href="#">
                    Upload
                </Link>
            </div> -->
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">ticket id</th>
                            <th class="whitespace-nowrap">closing date</th>
                            <th class="whitespace-nowrap">sub total</th>
                            <th class="whitespace-nowrap">total</th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
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
                                {{ ticket.closing_date }}
                            </td>
                            <td>
                                {{ ticket.sub_total }}
                            </td>
                            <td>
                                {{ ticket.total }}
                            </td>
                            <td class="table-report__action w-56">
                                <!-- <div class="flex justify-center items-center">
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.address.edit', {
                                                branch: branch.id,
                                                address: add.id,
                                            })
                                        "
                                    >
                                        <EditIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.update") }}
                                    </Link>
                                </div> -->
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
import { useI18n } from "vue-i18n";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
const { t } = useI18n();
const props = defineProps({
    invoices: Object,
    branch: Object,
});
</script>
<style></style>
