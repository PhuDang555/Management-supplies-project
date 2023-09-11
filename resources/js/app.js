import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
const el = document.getElementById("app");

import toastr from "toastr";

// Thiết lập các tùy chọn mặc định cho Toastr
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: 5000, // Thời gian hiển thị thông báo (ms)
};

// Sử dụng Toastr để hiển thị thông báo
// toastr.success('Đây là thông báo thành công.');
// toastr.error('Đây là thông báo lỗi.');
// toastr.warning('Đây là thông báo cảnh báo.');
// toastr.info('Đây là thông báo thông tin.');

createApp({
    render: renderSpladeApp({ el }),
})
    .use(SpladePlugin, {
        max_keep_alive: 10,
        transform_anchors: false,
        progress_bar: true,
    })
    .mount(el);
