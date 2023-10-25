
<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Projects" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Project</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit" enctype="multipart/form-data">

                        <div class="space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    ref="nameInput"
                                    v-model="form.name"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="name-input"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Value" />
                                <TextInput
                                    id="email"
                                    ref="emailInput"
                                    v-model="form.value"
                                    type="number"
                                    class="mt-1 block w-full"
                                />

                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="status" value="Project Status" />
                                <select
                                    id="company-id"
                                    ref="companyInput"
                                    v-model="form.status"
                                    type="text"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full"
                                    autocomplete="company-id-input"
                                >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div>
                                <InputLabel for="start_date" value="Start Date" />
                                <input type="date" v-model="form.start_date" class="block w-full border-gray-300"/>
                            </div>
                            <div>
                                <InputLabel for="end_date" value="End Date" />
                                <input type="date" v-model="form.end_date" class="block w-full border-gray-300"/>
                            </div>
                        </div>


                        <div class="mt-8">
                            <PrimaryButton type="submit">Update Project</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
    },
    props: {
        project: Object
    },
    data() {
        return {
            form: useForm({
                name: this.project.name,
                status: this.project.status,
                start_date: this.project.start_date,
                end_date: this.project.end_date,
                value: this.project.value,
                _method: 'put',
            })
        };
    },
    methods: {
        submit() {
            this.form.post(route("projects.update", this.project.id), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                    if (this.form.errors.logo) {
                        this.form.reset('logo');
                    }
                },
            });
        }
    }
};
</script>
