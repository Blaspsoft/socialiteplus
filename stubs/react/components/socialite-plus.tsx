import FacebookIcon from "@/components/icons/facebook";
import GithubIcon from "@/components/icons/github";
import GoogleIcon from "@/components/icons/google";
import { Button } from "@/components/ui/button";
import LinkedInIcon from "./icons/linkedin";

interface Provider {
  name: string;
  icon: "FacebookIcon" | "GithubIcon" | "GoogleIcon" | "LinkedInIcon";
  branded: boolean;
}

interface SocialitePlusProps {
  providersConfig: {
    button_text: string;
    providers: Provider[];
  };
}

const getProviderClasses = (provider: Provider) => {
  if (!provider.branded) return;

  const styles: Record<string, string> = {
    Google:
      "bg-red-500 hover:bg-red-600 hover:text-white text-white dark:bg-red-600 dark:hover:bg-red-700",
    Facebook:
      "bg-blue-600 hover:bg-blue-700 hover:text-white text-white dark:bg-blue-700 dark:hover:bg-blue-800",
    Github:
      "bg-gray-900 hover:bg-gray-700 hover:text-white text-white dark:border-white dark:bg-transparent dark:hover:bg-gray-900",
    LinkedIn:
      "bg-blue-700 hover:bg-blue-800 hover:text-white text-white dark:bg-blue-800 dark:hover:bg-blue-900",
  };

  return styles[provider.name] || "";
};

const iconMap = {
  GoogleIcon: GoogleIcon,
  FacebookIcon: FacebookIcon,
  GithubIcon: GithubIcon,
  LinkedInIcon: LinkedInIcon,
};

export default function SocialitePlus({ providersConfig }: SocialitePlusProps) {
  return (
    <>
      <div className="flex gap-4 items-center">
        <div className="flex-1">
          <div className="w-full h-px bg-border" />
        </div>
        or
        <div className="flex-1">
          <div className="w-full h-px bg-border" />
        </div>
      </div>

      <div className="flex flex-col gap-4">
        {providersConfig.providers.map((provider) => {
          const IconComponent = iconMap[provider.icon];
          return (
            <Button
              key={provider.name}
              type="button"
              variant="outline"
              className={getProviderClasses(provider)}
              tabIndex={5}
              onClick={() =>
                (window.location.href = route("social.redirect", {
                  provider: provider.name,
                }))
              }
            >
              {IconComponent && <IconComponent className="size-6" />}
              {providersConfig.button_text.replace("{provider}", provider.name)}
            </Button>
          );
        })}
      </div>
    </>
  );
}
