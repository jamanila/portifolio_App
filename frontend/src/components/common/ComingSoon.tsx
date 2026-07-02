import Container from '@/components/common/Container'

export default function ComingSoon({ title }: { title: string }) {
  return (
    <section className="py-24">
      <Container className="text-center">
        <h1 className="text-3xl font-bold text-neutral-900 dark:text-white sm:text-4xl">{title}</h1>
        <p className="mt-4 text-neutral-500 dark:text-neutral-400">
          This page is under construction and will be built out in the next phase.
        </p>
      </Container>
    </section>
  )
}
