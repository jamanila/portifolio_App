import { motion } from 'framer-motion'
import { FaLayerGroup } from 'react-icons/fa6'
import Container from '@/components/common/Container'
import SectionHeading from '@/components/common/SectionHeading'
import Skeleton from '@/components/ui/Skeleton'
import { useFetch } from '@/hooks/useFetch'
import { listServices } from '@/services/serviceCatalog'

export default function ServicesSection() {
  const { data: services, isLoading } = useFetch(listServices, [])

  if (!isLoading && (!services || services.length === 0)) {
    return null
  }

  return (
    <section className="py-20">
      <Container>
        <SectionHeading eyebrow="Services" title="What I can build for you" center />

        <div className="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {isLoading
            ? Array.from({ length: 6 }).map((_, i) => <Skeleton key={i} className="h-48" />)
            : services?.map((service, index) => (
                <motion.div
                  key={service.id}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true, margin: '-50px' }}
                  transition={{ duration: 0.4, delay: index * 0.05 }}
                  className="rounded-2xl border border-neutral-200 bg-white p-6 transition-shadow hover:shadow-lg dark:border-neutral-800 dark:bg-neutral-900"
                >
                  <div className="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                    <FaLayerGroup size={20} />
                  </div>
                  <h3 className="mt-4 text-lg font-semibold text-neutral-900 dark:text-white">{service.title}</h3>
                  <p className="mt-2 text-sm text-neutral-600 dark:text-neutral-400">{service.description}</p>
                </motion.div>
              ))}
        </div>
      </Container>
    </section>
  )
}
