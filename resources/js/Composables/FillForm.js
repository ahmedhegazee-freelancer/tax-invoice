export const fillForm = (form, model) => {
    Object.keys(form).forEach((key) => {
        if (model[key] != undefined) form[key] = model[key];
    });
};
