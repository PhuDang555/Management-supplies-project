<template>
    <div>
        <canvas ref="chart"></canvas>
    </div>
</template>

<script>
import Chart from "chart.js";

export default {
    mounted() {
        this.renderChart();
    },
    methods: {
        renderChart() {
            // Logic để tạo và cấu hình biểu đồ
            const ctx = this.$refs.chart.getContext("2d");
            new Chart(ctx, {
                type: "bar", // Loại biểu đồ (ví dụ: bar, line, pie)
                data: {
                    // Dữ liệu cho biểu đồ
                    labels: ["Label 1", "Label 2", "Label 3"],
                    datasets: [
                        {
                            label: "Dataset",
                            data: [10, 20, 30],
                        },
                    ],
                },
                options: {
                    // Cấu hình thêm cho biểu đồ (ví dụ: tiêu đề, màu sắc, định dạng...)
                },
            });
        },
    },
};
</script>
