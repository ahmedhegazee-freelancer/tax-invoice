<script setup>
import TopBar from "@/components/top-bar/Main.vue";
import MobileMenu from "@/Components/mobile-menu/Main.vue";
import SideMenu from "@/Components/SideMenu.vue";
import { computed, watch, ref, provide } from "@vue/runtime-core";
import { Head, usePage } from "@inertiajs/inertia-vue3";
// Success notification
const successNotification = ref();

provide("bind[successNotification]", (el) => {
    // Binding

    successNotification.value = el;
});
const successNotificationToggle = () => {
    // Show notification
    successNotification.value.showToast();
};

const errorNotification = ref();
provide("bind[errorNotification]", (el) => {
    // Binding
    errorNotification.value = el;
});
const errorNotificationToggle = () => {
    // Show notification
    errorNotification.value.showToast();
};
const flashMessage = computed(() => usePage().props.value.flash);

watch(flashMessage, (newMessage) => {
    if (newMessage.type == "success") {
        successNotificationToggle();
    }
    if (newMessage.type == "error") errorNotificationToggle();
});
</script>

<template>
    <Head title="TaxInvoices Dashboard" />
    <div class="py-2">
        <MobileMenu />
        <div class="flex mt-[4.7rem] md:mt-0">
            <Notification
                refKey="successNotification"
                class="flex"
                :options="{
                    duration: 3000,
                }"
            >
                <CheckCircleIcon class="text-success" />
                <div class="ml-4 mr-4">
                    <div class="font-medium">Success</div>
                    <div class="text-slate-500 mt-1">
                        {{ flashMessage.message }}
                    </div>
                </div>
            </Notification>
            <!-- <Notification
                refKey="errorNotification"
                class="flex"
                :options="{
                    duration: 3000,
                }"
            >
                <XCircleIcon class="text-danger" />
                <div class="ml-4 mr-4">
                    <div class="font-medium">Error</div>
                    <div class="text-slate-500 mt-1">
                        {{ flashMessage.message }}
                    </div>
                </div>
            </Notification> -->
            <!-- BEGIN: Side Menu -->
            <SideMenu />
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <TopBar />
                <slot />
            </div>
            <!-- END: Content -->
        </div>
    </div>
</template>
