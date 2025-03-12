<script setup lang="ts">
import { Button } from "@/components/ui/button";
import FacebookIcon from "./Icons/FacebookIcon.vue";
import GitHubIcon from "./Icons/GitHubIcon.vue";
import GoogleIcon from "./Icons/GoogleIcon.vue";
import LinkedInIcon from "./Icons/LinkedInIcon.vue";

defineProps<{
  providersConfig: {
    button_text: string;
    providers: { name: string; icon: ProviderIcon; branded: boolean }[];
  };
}>();

const icons = {
  GoogleIcon,
  FacebookIcon,
  GitHubIcon,
  LinkedInIcon,
} as const;

type ProviderIcon = keyof typeof icons;

const providerClasses = (provider: { name: string; branded: boolean }) => {
  if (!provider.branded) return;

  const styles: Record<string, string> = {
    Google:
      "bg-red-500 hover:bg-red-600 hover:text-white text-white dark:bg-red-600 dark:hover:bg-red-700",
    Facebook:
      "bg-blue-600 hover:bg-blue-700 hover:text-white text-white dark:bg-blue-700 dark:hover:bg-blue-800",
    GitHub:
      "bg-gray-900 hover:bg-gray-700 hover:text-white text-white dark:border-white dark:bg-transparent dark:hover:bg-gray-900",
    LinkedIn:
      "bg-blue-700 hover:bg-blue-800 hover:text-white text-white dark:bg-blue-800 dark:hover:bg-blue-900",
  };

  return styles[provider.name] || "";
};

const redirect = (provider: string) => {
  window.location.href = route("social.redirect", { provider });
};
</script>

<template>
  <div class="flex items-center gap-4">
    <div class="flex-1">
      <div class="h-px w-full bg-border" />
    </div>
    or
    <div class="flex-1">
      <div class="h-px w-full bg-border" />
    </div>
  </div>
  <div class="flex flex-col gap-4">
    <template
      v-for="provider in providersConfig.providers"
      :key="provider.name"
    >
      <Button
        type="button"
        variant="outline"
        :class="providerClasses(provider)"
        :tabIndex="5"
        @click="redirect(provider.name)"
      >
        <component
          :is="icons[provider.icon]"
          class="size-6"
          v-if="icons[provider.icon]"
        />
        {{ providersConfig.button_text.replace("{provider}", provider.name) }}
      </Button>
    </template>
  </div>
</template>
