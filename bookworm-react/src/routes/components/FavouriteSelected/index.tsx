import ReturnToLink from 'components/ReturnToLink';
import StarRating from 'components/StarRating';
import StylizedTextField from 'components/StylisedTextfield';
import fakerBooks from 'faker/fakerBooks';
import { useParams } from 'react-router-dom';
import Content from '../../../components/theme/Content';
import './styles.scss';

const Favourites = () => {

    const { id } = useParams();
    const book = fakerBooks(1)[0];

    return (
        <Content id='favourite-selected'>

            <div className="my-10"></div>

            <div className='banner'>
                <div className='summary'>
                    <div className='title'>
                        <p>{book.title}</p>
                    </div>
                    <div className="author">
                        <p>by <span className="capitalize">{book.authors[0]}</span></p>
                    </div>
                </div>
                <div className="image-darker"></div>
                <div className='image' style={{ backgroundImage: `url(${book.image})` }}></div>
            </div>

            <div className="my-10"></div>

            <h1 className='heading-1'>Edit</h1>

            <div className="my-10"></div>

            <StylizedTextField
                label='Rating'
                value='12 GBP'
                onChange={(value) => null}
            />

            <div className="my-10"></div>

            <StylizedTextField
                label='Rating'
                EditComponent={(
                    <StarRating rating={4.5} onClick={(value: number) => null} />
                )}
            />

            <div className="my-10"></div>

            <ReturnToLink url='/favourites' text='Favourites' />

        </Content>
    )
}

export default Favourites