<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("sidebar.settings") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.name") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.value") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(setting, fakerKey) in props.settings"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td>
                                {{ t(`admin.settings.${setting.key}`) }}
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <input
                                        id="crud-form-1"
                                        type="text"
                                        class="form-control w-full"
                                        v-model="form[setting.key]"
                                        placeholder="Name"
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors[setting.key]"
                                    />
                                    <FrontErrorMessage
                                        :errors="v$[setting.key].$errors"
                                    />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div class="text-right mt-5">
                <button
                    type="button"
                    class="btn btn-primary w-24"
                    @click="submitForm()"
                >
                    {{ t("admin.update") }}
                </button>
            </div>
            <!-- END: Pagination -->
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
import { onMounted } from "@vue/runtime-core";
// use as global scope

const { t } = useI18n(); // use as global scope
const props = defineProps({
    settings: Array,
});
const form = useForm({
    phone: "",
    whatsapp: "",
    facebook: "",
    instagram: "",
    twitter: "",
    snapchat: "",
    youtube: "",
    // version: "",
});
const rules = computed(() => validations());
const v$ = useVuelidate(rules, form);

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;
    form.post(route("dashboard.setting.store"), {
        onSuccess: () => {
            Inertia.visit(route("dashboard.setting.index"));
        },
    });
};

onMounted(() => {
    const model = props.settings;
    Object.keys(form).forEach((key) => {
        if (model[key] != undefined) form[key] = model[key].value;
    });
});
</script>
<style></style>
