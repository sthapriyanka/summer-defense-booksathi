
import Chart from 'chart.js/auto';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

window.Chart = Chart;

Alpine.store('sidebar', {
    collapsed: false,
    mouseInside: false,

    init() {
        this.collapsed = JSON.parse(localStorage.getItem('sidebar-collapsed')) ?? false;
        this._persist();
    },

    _persist() {
        localStorage.setItem('sidebar-collapsed', JSON.stringify(this.collapsed));
    },

    expandOnHover() {
        const sidebar = Alpine.store('sidebar');
        if (sidebar.collapsed) {
            sidebar.mouseInside = true;
            sidebar.collapsed = false;
        }
    },

    collapseOnLeave() {
        const sidebar = Alpine.store('sidebar');
        if (!sidebar.collapsed && sidebar.mouseInside) {
            sidebar.mouseInside = false;
            sidebar.collapsed = true;
        }
    },

    toggle() {
        this.collapsed = !this.collapsed;
        this._persist();
    }
});

Livewire.start();
