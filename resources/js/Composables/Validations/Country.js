import { required, minLength, maxLength, helpers } from "@vuelidate/validators";
import { useI18n } from "vue-i18n";
import { nameValidationRules } from "./NameValidation";

export function validations() {
    const { t } = useI18n(); // use as global scope

    const validatePhoneCode = (phoneCode) => /^(\+[0-9]{1,4})$/.test(phoneCode);
    const validateRegex = (regexString) => {
        try {
            new RegExp(regexString);
            return true;
        } catch (error) {
            return false;
        }
    };
    return {
        ...nameValidationRules(),
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
                    min: 2,
                }),
                minLength(2)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.code"),
                    max: 4,
                }),
                maxLength(4)
            ),
        },
        phone_code: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.phone_code"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.phone_code"),
                    min: 2,
                }),
                minLength(2)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.phone_code"),
                    max: 5,
                }),
                maxLength(5)
            ),
            validatePhoneCode: helpers.withMessage(
                t("validation.regex", {
                    attribute: t("validation.attributes.phone_code"),
                }),
                validatePhoneCode
            ),
        },
        regex: {
            required: helpers.withMessage(
                t("validation.required", {
                    attribute: t("validation.attributes.regex"),
                }),
                required
            ),
            minLength: helpers.withMessage(
                t("validation.min.string", {
                    attribute: t("validation.attributes.regex"),
                    min: 2,
                }),
                minLength(2)
            ),
            maxLength: helpers.withMessage(
                t("validation.max.string", {
                    attribute: t("validation.attributes.regex"),
                    max: 150,
                }),
                maxLength(150)
            ),
            validateRegex: helpers.withMessage(
                t("validation.regex", {
                    attribute: t("validation.attributes.regex"),
                }),
                validateRegex
            ),
        },
    };
}
