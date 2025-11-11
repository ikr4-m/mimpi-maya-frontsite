import { FunctionComponent } from "preact";

type ContainerProps = {
  className?: string;
}

export const TopContainer: FunctionComponent<ContainerProps> = (p) => {
  return (
    <div className={`h-[calc(100vh-4rem)] ${p.className}`}>
      {p.children}
    </div>
  )
}
