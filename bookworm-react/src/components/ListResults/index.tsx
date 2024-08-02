import {Book} from 'types/books.t';
import ListItem from './ListItem';
import useFavouriteBooks from "../../hooks/Books/useFavouriteBooks";

type Props = {
    results: Book[]
    onClick?: (book: Book) => any;
    onRefresh?: (...args: any[]) => any;
}

const ListResults = ({results, onClick, onRefresh}: Props) => {

    const {books: favouriteBooks} = useFavouriteBooks()

    return (
        <div className="ListResults">
            {results.map((book: Book) => (
                <ListItem className='mb-5' key={book._id} book={book} onClick={onClick} onRefresh={onRefresh}
                          favouriteBooks={favouriteBooks}/>
            ))}
        </div>
    )
}

export default ListResults;