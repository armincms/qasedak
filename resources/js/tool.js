Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'qasedak',
      path: '/qasedak',
      component: require('./components/Tool'),
    },
  ])
})
