import { ref } from 'vue';

export function useCsrfToken() {
    const token = ref(document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
    return { token };
}
