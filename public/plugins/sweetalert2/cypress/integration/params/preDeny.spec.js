import { Swal, SwalWithoutAnimation } from '../../utils'

describe('preDeny', () => {
  it('preDeny return false', () => {
    SwalWithoutAnimation.fire({
      showDenyButton: true,
      preDeny: (value) => {
        expect(value).to.be.false
        return false
      }
    })
    Swal.clickDeny()
    expect(Swal.isVisible()).to.be.true
  })

  it('preDeny custom value', (done) => {
    SwalWithoutAnimation.fire({
      showDenyButton: true,
      input: 'text',
      inputValue: 'Initial input value',
      returnInputValueOnDeny: true,
      preDeny: (value) => `${value} + Some data from preDeny`,
    }).then(result => {
      expect(result.value).to.equal('Initial input value + Some data from preDeny')
      done()
    })
    Swal.clickDeny()
  })

  it('preDeny returns 0', (done) => {
    SwalWithoutAnimation.fire({
      showDenyButton: true,
      preDeny: () => 0,
    }).then(result => {
      expect(result.value).to.equal(0)
      done()
    })
    Swal.clickDeny()
  })

  it('preDeny returns object containing toPromise', (done) => {
    SwalWithoutAnimation.fire({
      showDenyButton: true,
      didOpen: () => Swal.clickDeny(),
      preDeny: () => ({
        toPromise: () => Promise.resolve(0)
      })
    }).then(result => {
      expect(result.value).to.equal(0)
      done()
    })
  })
})
