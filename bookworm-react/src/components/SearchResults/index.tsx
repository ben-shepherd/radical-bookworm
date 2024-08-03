import ListResults from 'components/ListResults';
import { ListItemEventProps } from 'components/ListResults/ListItem';
import React from 'react';
import { Book } from 'types/books.t';

type Props = {
    results: Book[];
    PreSearchComponent?: () => React.ReactNode | null,
    PostSearchComponent: (searchResultsComponent: React.ReactNode) => React.ReactNode;
    onClick?: (book: Book) => any;
    onRefresh?: (...args: any[]) => any;
}

const SearchResults = ({
                           results,
                           PreSearchComponent,
                           PostSearchComponent,
                           ...listItemProps
                       }: Props & ListItemEventProps ): React.ReactNode => {

    if (PreSearchComponent && results.length === 0) {
        return PreSearchComponent()
    }

    return PostSearchComponent(
        <ListResults results={results} {...listItemProps} />
    )
}

export default SearchResults