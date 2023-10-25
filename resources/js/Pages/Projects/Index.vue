<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Projects" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link :href="route('projects.create')">
                        <PrimaryButton>Create Project</PrimaryButton>
                    </Link>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <tr>
                            <th class="p-4 text-left">ID</th>
                            <th class="p-4 text-center">Name</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 text-center">Start Date</th>
                            <th class="p-4">End Date</th>
                            <th class="p-4">Actions</th>
                        </tr>
                        <tr v-for="projeto in projetos" :key="projeto.id">
                            <td class="px-4 py-2">{{ projeto.id }}</td>
                            <td class="px-4 py-2 text-center">{{ projeto.name }}</td>
                            <td class="px-4 py-2 text-center">{{ projeto.status }}</td>
                            <td class="px-4 py-2 text-center">{{ new Date(projeto.start_date).toLocaleDateString()}}</td>
                            <td class="px-4 py-2 text-center">{{ new Date(projeto.end_date).toLocaleDateString()}}</td>
                            <td class="text-white px-4 py-2 space-x-4 text-center">
                                <Link :href="route('projects.show', projeto.id)">
                                    <PrimaryButton>Show</PrimaryButton>
                                </Link>
                                <Link :href="route('projects.edit', projeto.id)">
                                    <PrimaryButton>Edit</PrimaryButton>
                                </Link>
                                <PrimaryButton @click="deleteProject(projeto)">Delete</PrimaryButton>
                            </td>
                        </tr>
                    </table>
                </div>

                <div>
                    <Link v-if="projetos.prev_page_url" :href="projetos.prev_page_url">Previous</Link>
                    <Link v-if="projetos.next_page_url" :href="projetos.next_page_url">Next</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
    },
    props: {
        projetos: Object
    },
    data() {
        return {
            form: useForm({
            })
        };
    },
    mounted() {
    },
    methods: {
        deleteProject(item){
            this.form.delete(route('projects.destroy', item.id), {
                preserveScroll: true,
                onSuccess: () => {},
                onError: () => {},
                onFinish: () => {},
            });
        },
    },
};
</script>
