interface SectionHeadingProps {
  eyebrow?: string
  title: string
  description?: string
  center?: boolean
}

export default function SectionHeading({ eyebrow, title, description, center = false }: SectionHeadingProps) {
  return (
    <div className={`max-w-2xl ${center ? 'mx-auto text-center' : ''}`}>
      {eyebrow && (
        <p className="text-sm font-semibold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">
          {eyebrow}
        </p>
      )}
      <h2 className="mt-2 text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl">
        {title}
      </h2>
      {description && (
        <p className="mt-4 text-base text-neutral-600 dark:text-neutral-400">{description}</p>
      )}
    </div>
  )
}
