
<template>
    <AuthenticatedLayout>
        <!-- Title -->

        <Head title="Projects" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">View Project</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit" enctype="multipart/form-data">

                        <div class="space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" ref="nameInput" v-model="form.name" type="text" class="block w-full"
                                    autocomplete="name-input" disabled="true" />
                            </div>

                            <div>
                                <InputLabel for="value" value="Value" />
                                <TextInput id="value" ref="emailInput" v-model="form.value" type="text"
                                    class="mt-1 block w-full" autocomplete="email-input" disabled="true" />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="status" value="Project Status" />
                                <TextInput id="value" ref="emailInput" v-model="form.status" type="text"
                                    class="mt-1 block w-full" autocomplete="email-input" disabled="true" />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="status" value="Start Date" />
                                <TextInput id="value" ref="emailInput" v-model="form.start_date" type="text"
                                    class="mt-1 block w-full" autocomplete="email-input" disabled="true" />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="status" value="End Date" />
                                <TextInput id="value" ref="emailInput" v-model="form.end_date" type="text"
                                    class="mt-1 block w-full" autocomplete="email-input" disabled="true" />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>
                            <div>
                                <InputLabel for="status" value="Creator" />
                                <TextInput id="value" ref="emailInput" v-model="form.creator" type="text"
                                    class="mt-1 block w-full" autocomplete="email-input" disabled="true" />
                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

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
                value: this.formatCurrency(this.project.value),
                status: this.project.status,
                start_date: new Date(this.project.start_date).toLocaleDateString(),
                end_date: new Date(this.project.end_date).toLocaleDateString(),
                creator: this.project.creator.name,
            })
        };
    },
    methods: {
        formatCurrency(value) {
            if (typeof value === 'number') {
                return value.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL',
                });
            }
            return value; // Caso o valor não seja um número, retorne sem formatação.
        },
    }
};
</script>
