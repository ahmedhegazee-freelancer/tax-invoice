<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.transactions") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <TomSelect
                    id="crud-form-2"
                    v-model="statusFilter"
                    class="w-full"
                    :options="{
                        create: false,
                    }"
                >
                    <option value="">
                        {{ t("admin.approved_statuses.all") }}
                    </option>
                    <option value="pending">
                        {{ t("admin.approved_statuses.pending") }}
                    </option>
                    <option value="accepted">
                        {{ t("admin.approved_statuses.accepted") }}
                    </option>
                    <option value="cancelled">
                        {{ t("admin.approved_statuses.cancelled") }}
                    </option>
                </TomSelect>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.id") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.customer_name") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.payment_no") }}
                            </th>

                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.phone") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.total") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.discount") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.paid") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.coupon_code") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.status") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(transaction, fakerKey) in props.transactions
                                .items"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{
                                    fakerKey +
                                    1 +
                                    15 * (props.transactions.current_page - 1)
                                }}
                            </td>
                            <td>{{ transaction.customer_name }}</td>
                            <td>{{ transaction.payment_no }}</td>
                            <td>{{ transaction.phone }}</td>
                            <td>{{ transaction.total }}</td>
                            <td>{{ transaction.discount }}</td>
                            <td>{{ transaction.paid }}</td>
                            <td>{{ transaction.coupon_code }}</td>
                            <td>{{ transaction.status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.transactions.links" />
            </div>
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { ref, computed } from "@vue/reactivity";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import InputError from "@/Components/InputError.vue";
import useVuelidate from "@vuelidate/core";
import { validations } from "@/Composables/Validations/Setting";
import { onMounted, watch } from "@vue/runtime-core";
// use as global scope
const statusFilter = ref("");
const { t } = useI18n(); // use as global scope
const props = defineProps({
    transactions: Array,
});
watch(statusFilter, (newStatus) => {
    Inertia.reload({ only: ["transactions"] });
});
</script>
<style></style>
