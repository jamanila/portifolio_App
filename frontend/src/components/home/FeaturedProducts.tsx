import Container from '@/components/common/Container'
import SectionHeading from '@/components/common/SectionHeading'
import Button from '@/components/ui/Button'
import Skeleton from '@/components/ui/Skeleton'
import ProductCard from '@/components/products/ProductCard'
import { useFetch } from '@/hooks/useFetch'
import { getFeaturedProducts } from '@/services/products'

export default function FeaturedProducts() {
  const { data: products, isLoading } = useFetch(getFeaturedProducts, [])

  if (!isLoading && (!products || products.length === 0)) {
    return null
  }

  return (
    <section className="bg-neutral-50 py-20 dark:bg-neutral-900/40">
      <Container>
        <div className="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
          <SectionHeading eyebrow="Marketplace" title="Featured Products" />
          <Button to="/products" variant="secondary">
            Browse All Products
          </Button>
        </div>

        <div className="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {isLoading
            ? Array.from({ length: 3 }).map((_, i) => <Skeleton key={i} className="h-80" />)
            : products?.map((product) => <ProductCard key={product.id} product={product} />)}
        </div>
      </Container>
    </section>
  )
}
