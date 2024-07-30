import { Book } from 'types/books.t';
import ListItem from './ListItem';

type Props = {
    results: Book[]
    onClick?: (book: Book) => any
}

const ListResults = ({ results, onClick }: Props) => {
    return (
        <div className="ListResults">
        {results.map((book: Book) => (
            <ListItem className='mb-5' key={book.id} book={book} onClick={onClick} />
        ))}
    </div>
    )
}

export default ListResults;