import { helpers, maxLength, minLength, required } from "@vuelidate/validators";
import {
    validateArabicLetters,
    validateEnglishLetters,
} from "./languagesCharacterTest";
import { useI18n } from "vue-i18n";

export const nameValidationRules = () => {
    const { t } = useI18n(); // use as global scope
    return {
        name: {
            ar: {
                required: helpers.withMessage(
                    t("validation.required", { attribute: "name" }),
                    required
                ),
                minLength: helpers.withMessage(
                    t("validation.min.string", {
                        attribute: t("validation.attributes.name"),
                        min: 3,
                    }),
                    minLength(3)
                ),
                maxLength: helpers.withMessage(
                    t("validation.max.string", {
                        attribute: t("validation.attributes.name"),
                        max: 120,
                    }),
                    maxLength(120)
                ),
                validateArabicLetters: helpers.withMessage(
                    t("validation.regex", {
                        attribute: t("validation.attributes.name"),
                    }),
                    validateArabicLetters
                ),
            },
            en: {
                required: helpers.withMessage(
                    t("validation.required", { attribute: "name" }),
                    required
                ),
                minLength: helpers.withMessage(
                    t("validation.min.string", {
                        attribute: t("validation.attributes.name"),
                        min: 3,
                    }),
                    minLength(3)
                ),
                maxLength: helpers.withMessage(
                    t("validation.max.string", {
                        attribute: t("validation.attributes.name"),
                        max: 120,
                    }),
                    maxLength(120)
                ),
                validateEnglishLetters: helpers.withMessage(
                    t("validation.regex", {
                        attribute: t("validation.attributes.name"),
                    }),
                    validateEnglishLetters
                ),
            },
        },
    };
};
