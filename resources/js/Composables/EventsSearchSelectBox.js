import { ref } from "vue";

export const selectOptions = ref({
    create: false,
    valueField: "id",
    labelField: "title",
    searchField: "title",
    // fetch remote data
    load: function (query, callback) {
        var url = route("event-search", { q: encodeURIComponent(query) });
        // "https://api.github.com/search/repositories?q=" +
        // encodeURIComponent(query);
        // console.log(query);
        fetch(url)
            .then((response) => response.json())
            .then((json) => {
                callback(json.data);
            })
            .catch(() => {
                callback();
            });
    },
});

export const availableSelectOptions = ref({
    create: false,
    valueField: "id",
    labelField: "title",
    searchField: "title",
    // fetch remote data
    load: function (query, callback) {
        var url = route("event-search", { q: query, status: 0 });
        // "https://api.github.com/search/repositories?q=" +
        // encodeURIComponent(query);
        // console.log(query);
        fetch(url)
            .then((response) => response.json())
            .then((json) => {
                callback(json.data);
            })
            .catch(() => {
                callback();
            });
    },
});
