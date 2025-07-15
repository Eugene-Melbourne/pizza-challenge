<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import PizzaTable from '../components/PizzaTable.vue';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const pizzas = usePage().props.pizzas ?? [];

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="usePage().props.flash?.success" class="mb-4 rounded bg-green-100 p-3 text-green-800">
            {{ usePage().props.flash.success }}
        </div>
        <div v-if="usePage().props.flash?.info" class="mb-4 rounded bg-blue-100 p-3 text-blue-800">
            {{ usePage().props.flash.info }}
        </div>
        <div v-if="usePage().props.flash?.error" class="mb-4 rounded bg-red-100 p-3 text-red-800">
            {{ usePage().props.flash.error }}
        </div>
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 p-4 md:min-h-min dark:border-sidebar-border">
                <PizzaTable :pizzas="pizzas" />
            </div>
        </div>
    </AppLayout>
</template>
