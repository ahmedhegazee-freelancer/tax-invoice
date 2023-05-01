import { helpers, maxLength, minLength, required } from "@vuelidate/validators";
import { useI18n } from "vue-i18n";
import {
    validateArabicLetters,
    validateEnglishLetters,
} from "./languagesCharacterTest";

export function validations() {
    const { t } = useI18n();
    const validationRules = {
        title: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.title"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.title"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.title"),
                    max: 120,
                }),
                maxLength(120)
            ),
        },

        content: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.description"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.description"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.description"),
                    max: 2000,
                }),
                maxLength(2000)
            ),
        },
    };
    const validations = {
        ar: {
            ...validationRules,
        },
        en: {
            ...validationRules,
        },
        start_date: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.start_date"),
                }),
                required
            ),
        },
        event: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.event"),
                }),
                required
            ),
        },
    };
    validations.ar.title.validateArabicLetters = helpers.withMessage(
        t("validation.regex", {
            attribute: t("validation.attributes.title"),
        }),
        validateArabicLetters
    );
    validations.en.title.validateArabicLetters = helpers.withMessage(
        t("validation.regex", {
            attribute: t("validation.attributes.title"),
        }),
        validateEnglishLetters
    );
    return validations;
}
