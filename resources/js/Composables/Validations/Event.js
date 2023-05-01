import { helpers, maxLength, minLength, required } from "@vuelidate/validators";
import { useI18n } from "vue-i18n";
import {
    validateArabicLetters,
    validateEnglishLetters,
} from "./languagesCharacterTest";

export function validations() {
    const { t } = useI18n();
    const validationRules = {};
    const validations = {
        ar: {
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
                validateArabicLetters: helpers.withMessage(
                    t("validation.regex", {
                        attribute: t("validation.attributes.address"),
                    }),
                    validateArabicLetters
                ),
            },
            address: {
                required: helpers.withMessage(
                    t("validation.required", {
                        attribute: t("validation.attributes.address"),
                    }),
                    required
                ),
                minLength: helpers.withMessage(
                    t("validation.min.string", {
                        attribute: t("validation.attributes.address"),
                        min: 3,
                    }),
                    minLength(3)
                ),
                maxLength: helpers.withMessage(
                    t("validation.max.string", {
                        attribute: t("validation.attributes.address"),
                        max: 120,
                    }),
                    maxLength(120)
                ),
                validateArabicLetters: helpers.withMessage(
                    t("validation.regex", {
                        attribute: t("validation.attributes.address"),
                    }),
                    validateArabicLetters
                ),
            },
            description: {
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
        },
        en: {
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
                validateEnglishLetters: helpers.withMessage(
                    t("validation.regex", {
                        attribute: t("validation.attributes.address"),
                    }),
                    validateEnglishLetters
                ),
            },
            address: {
                required: helpers.withMessage(
                    t("validation.required", {
                        attribute: t("validation.attributes.address"),
                    }),
                    required
                ),
                minLength: helpers.withMessage(
                    t("validation.min.string", {
                        attribute: t("validation.attributes.address"),
                        min: 3,
                    }),
                    minLength(3)
                ),
                maxLength: helpers.withMessage(
                    t("validation.max.string", {
                        attribute: t("validation.attributes.address"),
                        max: 120,
                    }),
                    maxLength(120)
                ),
                validateEnglishLetters: helpers.withMessage(
                    t("validation.regex", {
                        attribute: t("validation.attributes.address"),
                    }),
                    validateEnglishLetters
                ),
            },
            description: {
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
        },
        start_date: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.start_date"),
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
    validations.en.title.validateEnglishLetters = helpers.withMessage(
        t("validation.regex", {
            attribute: t("validation.attributes.title"),
        }),
        validateEnglishLetters
    );
    return validations;
}
