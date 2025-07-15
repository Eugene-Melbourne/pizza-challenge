<template>
    <div class="overflow-x-auto">
        <table class="min-w-full rounded-xl border bg-white dark:bg-gray-900">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Pizza ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Status Set At</th>
                    <th class="px-4 py-2 text-left">Created At</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="pizza in pizzas" :key="pizza.id">
                    <td class="px-4 py-2">{{ pizza.id }}</td>
                    <td class="px-4 py-2">{{ pizza.customer?.name || '—' }}</td>
                    <td class="px-4 py-2">{{ pizza.status?.key || '—' }}</td>
                    <td class="px-4 py-2">{{ pizza.status_set_at ? new Date(pizza.status_set_at).toLocaleString() : '—' }}</td>
                    <td class="px-4 py-2">{{ pizza.created_at ? new Date(pizza.created_at).toLocaleString() : '—' }}</td>
                    <td class="px-4 py-2">
                        <form :action="`/pizzas/${pizza.id}/advance-status`" method="POST">
                            <input type="hidden" name="_token" :value="$csrfToken" />
                            <button
                                type="submit"
                                class="rounded bg-blue-600 px-2 py-1 text-white hover:bg-blue-700"
                                :disabled="pizza.status?.key === 'dispatched'"
                            >
                                Advance Status
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';

defineProps<{
    pizzas: Array<{ id: number; customer?: { customer_name: string }; status?: { key: string }; status_set_at?: string; created_at?: string }>;
}>();
</script>

<style scoped>
table {
    border-collapse: collapse;
}
th,
td {
    border-bottom: 1px solid #e5e7eb;
}
th {
    background: #f3f4f6;
    font-weight: 600;
}
.dark th {
    background: #1f2937;
}
</style>
