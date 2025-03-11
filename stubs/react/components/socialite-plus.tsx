import FacebookIcon from "@/components/icons/facebook";
import GithubIcon from "@/components/icons/github";
import GoogleIcon from "@/components/icons/google";
import { Button } from "@/components/ui/button";
import LinkedInIcon from "./icons/linkedin";

interface SocialitePlusProps {
  providersConfig: {
    button_text: string;
    providers: { name: string; icon: string; style: string }[];
  };
}

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
        {Object.values(providersConfig.providers).map((provider) => (
          <Button
            key={provider.name}
            type="button"
            variant="outline"
            className={`${provider.style}`}
            tabIndex={5}
            onClick={() => {
              window.location.href = route("social.redirect", {
                provider: provider.name,
              });
            }}
          >
            {provider.icon === "FacebookIcon" ? (
              <FacebookIcon className="size-6" />
            ) : provider.icon === "GithubIcon" ? (
              <GithubIcon className="size-6" />
            ) : provider.icon === "GoogleIcon" ? (
              <GoogleIcon className="size-6" />
            ) : provider.icon === "LinkedInIcon" ? (
              <LinkedInIcon className="size-6" />
            ) : null}
            {providersConfig.button_text.replace("{provider}", provider.name)}
          </Button>
        ))}
      </div>
    </>
  );
}
