import { motion } from 'framer-motion'
import { Link } from 'react-router-dom'
import type { Product } from '@/types'

export default function ProductCard({ product }: { product: Product }) {
  const thumbnail = product.thumbnail ?? product.images?.[0]?.url

  return (
    <motion.div
      initial={{ opacity: 0, y: 20 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true, margin: '-50px' }}
      transition={{ duration: 0.4 }}
      className="group flex flex-col overflow-hidden rounded-2xl border border-neutral-200 bg-white transition-shadow hover:shadow-xl dark:border-neutral-800 dark:bg-neutral-900"
    >
      <div className="aspect-video overflow-hidden bg-neutral-100 dark:bg-neutral-800">
        {thumbnail ? (
          <img
            src={thumbnail}
            alt={product.name}
            loading="lazy"
            className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
          />
        ) : (
          <div className="flex h-full w-full items-center justify-center text-neutral-400">No image</div>
        )}
      </div>

      <div className="flex flex-1 flex-col p-6">
        <div className="flex items-start justify-between gap-2">
          <h3 className="text-lg font-semibold text-neutral-900 dark:text-white">{product.name}</h3>
          <span className="shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300">
            ${product.price}
          </span>
        </div>
        <p className="mt-2 flex-1 text-sm text-neutral-600 dark:text-neutral-400">{product.short_description}</p>

        <Link
          to={`/products/${product.slug}`}
          className="mt-6 inline-flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-600 to-violet-600 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-indigo-500 hover:to-violet-500"
        >
          Buy Now
        </Link>
      </div>
    </motion.div>
  )
}
