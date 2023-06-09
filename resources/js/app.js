import "./bootstrap";
import "../pace/pace";
import { Carousel, initTE } from "tw-elements";
import 'livewire-sortable';
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid.css";

initTE({
    Carousel,
});

document.addEventListener("alpine:init", () => {
    Alpine.data("topBtn", () => ({
        scrolltoTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        },
    }));
});

const topBtn = document.getElementById("topButton");
window.onscroll = () => {
    document.body.scrollTop > 20 || document.documentElement.scrollTop > 20
        ? topBtn.classList.remove("hidden")
        : topBtn.classList.add("hidden");
};

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

Alpine.plugin(collapse);
window.Alpine = Alpine;

import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid.css";

Alpine.start();
