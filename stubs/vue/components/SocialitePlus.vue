<script setup lang="ts">
import { Button } from "@/components/ui/button";
import FacebookIcon from "./Icons/FacebookIcon.vue";
import GitHubIcon from "./Icons/GitHubIcon.vue";
import GoogleIcon from "./Icons/GoogleIcon.vue";
import LinkedInIcon from "./Icons/LinkedInIcon.vue";

defineProps<{
  providersConfig: {
    button_text: string;
    providers: { name: string; icon: string; style: string }[];
  };
}>();

const redirect = (provider: string) => {
  window.location.href = route("social.redirect", {
    provider,
  });
};
</script>

<template>
  <div class="flex gap-4 items-center">
    <div class="flex-1">
      <div class="w-full h-px bg-border" />
    </div>
    or
    <div class="flex-1">
      <div class="w-full h-px bg-border" />
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
        :class="provider.style"
        tabIndex="{5}"
        @click="redirect(provider.name)"
      >
        <div v-if="provider.icon === 'GoogleIcon'">
          <GoogleIcon class="size-6" />
        </div>
        <div v-if="provider.icon === 'FacebookIcon'">
          <FacebookIcon class="size-6" />
        </div>
        <div v-if="provider.icon === 'GitHubIcon'">
          <GitHubIcon class="size-6" />
        </div>
        <div v-if="provider.icon === 'LinkedInIcon'">
          <LinkedInIcon class="size-6" />
        </div>
        {{ providersConfig.button_text.replace("{provider}", provider.name) }}
      </Button>
    </template>
  </div>
</template>
