<div
    x-data="{
        notifications: [],
        add(e) {
            this.notifications.push({
                id: e.timeStamp,
                type: e.detail.type,
                title: e.detail.title,
                content: e.detail.content,
            })
        },
        remove(notification) {
            this.notifications = this.notifications.filter(
                (i) => i.id !== notification.id,
            )
        },
    }"
    @notify.window="add($event)"
    aria-live="assertive"
    class="pointer-events-none fixed inset-0 z-200 flex items-end px-4 py-6 sm:items-start sm:p-6"
>
    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
        <!-- Notification -->
        <template x-for="notification in notifications" :key="notification.id">
            <div
                x-data="{
                    show: false,
                    init() {
                        this.$nextTick(() => (this.show = true))

                        setTimeout(() => this.transitionOut(), 5000)
                    },
                    transitionOut() {
                        this.show = false

                        setTimeout(() => this.remove(this.notification), 500)
                    },
                }"
                x-show="show"
                x-transition.duration.500ms
                class="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white ring-1 shadow-lg ring-black/5"
            >
                <div class="p-4">
                    <div class="flex items-start">
                        <!-- Icons -->
                        <div x-show="notification.type === 'info'" class="shrink-0">
                            <x-icons icon="circle-exclamation" class="h-6 w-6 text-yellow-600" />

                            <span class="sr-only">Information:</span>
                        </div>

                        <div x-show="notification.type === 'success'" class="shrink-0">
                            <x-icons icon="circle-check" class="h-6 w-6 text-green-600" />
                            <span class="sr-only">Success:</span>
                        </div>

                        <div x-show="notification.type === 'error'" class="shrink-0">
                            <x-icons icon="circle-xmark" class="h-6 w-6 text-red-600" />
                            <span class="sr-only">Error:</span>
                        </div>

                        <!-- Text -->

                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p class="text-sm font-medium text-gray-900" x-text="notification.title"></p>
                            <p class="mt-1 text-sm text-gray-500" x-text="notification.content"></p>
                        </div>

                        <!-- Remove button -->

                        <div class="flex shrink-0 items-center">
                            <button
                                @click="transitionOut()"
                                type="button"
                                class="inline-flex rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-hidden"
                            >
                                <span class="sr-only">Close</span>
                                <svg class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"
                                    />
                                </svg>
                                <span class="sr-only">Close notification</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
