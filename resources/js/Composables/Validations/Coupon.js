import {
    required,
    minLength,
    maxLength,
    helpers,
    numeric,
    minValue,
    maxValue,
} from "@vuelidate/validators";
import { useI18n } from "vue-i18n";
import { validateEnglishLetters } from "./languagesCharacterTest";

export function validations() {
    const { t } = useI18n(); // use as global scope
    const lessThan = (value, siblings) => value < siblings.to;
    const greatThan = (value, siblings) => value > siblings.from;

    return {
        code: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.code"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.code"),
                    min: 3,
                }),
                minLength(3)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.code"),
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
        amount: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.amount"),
                }),
                required
            ),
            minValue: helpers.withMessage(
                t("validation.min.numeric", {
                    attribute: t("validation.attributes.amount"),
                    value: 1,
                }),
                minValue(1)
            ),
            maxValue: helpers.withMessage(
                t("validation.max.numeric", {
                    attribute: t("validation.attributes.amount"),
                    value: 1000,
                }),
                maxValue(1000)
            ),
        },
        ended_at: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.ended_at"),
                }),
                required
            ),
        },
    };
}
