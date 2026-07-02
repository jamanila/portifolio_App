import { motion } from 'framer-motion'
import Container from '@/components/common/Container'
import Button from '@/components/ui/Button'
import { useSiteData } from '@/contexts/SiteDataContext'

export default function AboutPreview() {
  const { settings } = useSiteData()

  return (
    <section className="py-20">
      <Container>
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true, margin: '-100px' }}
          transition={{ duration: 0.5 }}
          className="mx-auto max-w-3xl text-center"
        >
          <p className="text-sm font-semibold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">
            About Me
          </p>
          <h2 className="mt-2 text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl">
            Building software that ships
          </h2>
          <p className="mt-4 text-base text-neutral-600 dark:text-neutral-400">
            {settings?.site_description ??
              "I'm a full-stack developer who designs, builds, and sells production-ready software — from custom web apps to reusable products."}
          </p>
          <div className="mt-8">
            <Button to="/about" variant="secondary">
              Read More
            </Button>
          </div>
        </motion.div>
      </Container>
    </section>
  )
}
