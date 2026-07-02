import { Helmet } from 'react-helmet-async'
import ComingSoon from '@/components/common/ComingSoon'

export default function NotFound() {
  return (
    <>
      <Helmet>
        <title>Page Not Found | Portfolio</title>
      </Helmet>
      <ComingSoon title="404 — Page Not Found" />
    </>
  )
}
