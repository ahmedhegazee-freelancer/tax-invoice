import { computed, onMounted, ref } from "vue";
export const selectedCountry = ref(null);
export const formattedPhone = ref("");

export const selectedCountryRegex = computed(
    () =>
        new RegExp(
            selectedCountry.value.regex.replace("/^", "^").replace("$/", "$")
            // .replace("\+", "\\+")
        )
);
export const validateCountry = (phone) => {
    return selectedCountryRegex.value.test(phone);
};
