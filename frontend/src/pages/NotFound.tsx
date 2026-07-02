import Seo from '@/components/common/Seo'
import Container from '@/components/common/Container'
import Button from '@/components/ui/Button'

export default function NotFound() {
  return (
    <>
      <Seo title="Page Not Found" description="The page you're looking for doesn't exist." />
      <section className="flex min-h-[60vh] items-center py-24">
        <Container className="text-center">
          <p className="text-sm font-semibold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">404</p>
          <h1 className="mt-2 text-3xl font-bold text-neutral-900 dark:text-white sm:text-4xl">Page not found</h1>
          <p className="mx-auto mt-4 max-w-md text-neutral-500 dark:text-neutral-400">
            The page you're looking for doesn't exist or may have been moved.
          </p>
          <div className="mt-8">
            <Button to="/" variant="primary">
              Go Home
            </Button>
          </div>
        </Container>
      </section>
    </>
  )
}
