function change_sale_status_js(id) {
    let xhr = new XMLHttpRequest();
    let data = new FormData();
    data.append(`sale`, id);
    xhr.open(`POST`, document.location.href);
    xhr.send(data);
    location.reload();
}